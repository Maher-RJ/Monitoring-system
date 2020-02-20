package com.example.agriculture

import android.content.Context
import android.content.Intent
import android.content.pm.ActivityInfo
import android.os.Bundle
import android.view.MenuItem
import androidx.appcompat.app.ActionBarDrawerToggle
import androidx.core.view.GravityCompat
import androidx.drawerlayout.widget.DrawerLayout
import com.google.android.material.navigation.NavigationView
import androidx.appcompat.app.AppCompatActivity
import androidx.appcompat.widget.Toolbar
import kotlinx.android.synthetic.main.nav_header_main.*
import kotlin.concurrent.fixedRateTimer
import android.widget.LinearLayout
import android.widget.Toast
import com.example.agriculture.adapter.ReadingAdapter
import com.example.agriculture.model.Node
import com.example.agriculture.model.RResponse
import com.example.agriculture.model.Reading
import kotlinx.android.synthetic.main.activity_listview.*
import kotlinx.android.synthetic.main.home.*
import org.json.JSONObject


class MainActivity : AppCompatActivity(), NavigationView.OnNavigationItemSelectedListener {

    lateinit var req: RequestMethod
    val path="reading"
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        setRequestedOrientation (ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);     //  Fixed Portrait orientation
        req=RequestMethod()
        val toolbar:Toolbar = findViewById(R.id.toolbar)
        toolbar.title=""
        setSupportActionBar(toolbar)
        val drawerLayout: DrawerLayout = findViewById(R.id.drawer_layout)
        val navView: NavigationView = findViewById(R.id.nav_view)
        val toggle = ActionBarDrawerToggle(
            this, drawerLayout, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close
        )
        drawerLayout.addDrawerListener(toggle)
        toggle.syncState()

        navView.setNavigationItemSelectedListener(this)
        // Handle the camera action
        // assuming your Wizard content is in content_wizard.xml
        val dynamicContent = findViewById(R.id.dynamic_content) as LinearLayout

        val wizardView = layoutInflater
            .inflate(R.layout.home, dynamicContent, false)

        // add the inflated View to the layout
        dynamicContent.addView(wizardView)
        fixedRateTimer("timer",false,0,5000){
            this@MainActivity.runOnUiThread {
                checkConnction()
                getDetials()
            }
        }
        getHome()
    }

    fun getHome() {
        // Volley post request with parameters
        var resp=req.getRequest(this, path,object : VolleyCallback {
            override fun onSuccessResponse(resp: RResponse, context: Context) {
                if (resp.error == "") {
                    val readings: List<Reading>? = JSONObject(resp.json).optJSONArray("data")
                        ?.let {
                            0.until(it.length()).map { i -> it.optJSONObject(i) }
                        } // returns an array of JSONObject
                        ?.map { Reading(it.toString()) }
                    var adapter: ReadingAdapter
                    adapter = ReadingAdapter(context, readings)
                    reading_listview.adapter = adapter
                }else {
                    if (resp.code == -1) {
                        Login.relogin("Token has been expire", context);
                    }
                    Toast.makeText(context, resp.error, Toast.LENGTH_LONG).show()
                }
            }
        });
    }


    fun getDetials(){
        Login.getStatus(this)
    }

    fun checkConnction() {
        val resp = req.getRequest(this, "check", object : VolleyCallback {
            override fun onSuccessResponse(resp: RResponse, context: Context) {
                if (resp.error == "") {
                    status_msg.text = "Online";
                } else {
                    if (resp.code == -1) {
                        Login.relogin("Token has been expire", context);
                    }
                    status_msg.text = resp.error;
                }
            }
        });
    }
    override fun onBackPressed() {
        val drawerLayout: DrawerLayout = findViewById(R.id.drawer_layout)
        if (drawerLayout.isDrawerOpen(GravityCompat.START)) {
            drawerLayout.closeDrawer(GravityCompat.START)
        } else {
            super.onBackPressed()
        }
    }


    override fun onNavigationItemSelected(item: MenuItem): Boolean {
        val dynamicContent = findViewById(R.id.dynamic_content) as LinearLayout
        if(dynamicContent.childCount >0)
            dynamicContent.removeViewAt(0)
        // Handle navigation view item clicks here.
        when (item.itemId) {
            /* R.id.nav_home -> {
                 val toolbar:Toolbar = findViewById(R.id.toolbar)
                 toolbar.title="Home"
                 // Handle the camera action
                 // assuming your Wizard content is in content_wizard.xml
                 val wizardView = layoutInflater
                     .inflate(R.layout.home, dynamicContent, false)
                 getHome();
 // add the inflated View to the layout
                 dynamicContent.addView(wizardView)
                 print("number "+dynamicContent.childCount )
             }
             R.id.nav_region -> {
                 val RegionIntent = Intent(this, RegionActivity::class.java)
                 startActivity(RegionIntent)
             }
             R.id.nav_nodes -> {
                 val RegionIntent = Intent(this, NodeActivity::class.java)
                 startActivity(RegionIntent)
             }
             R.id.nav_schedules -> {
                 val ScheduleIntent = Intent(this, scheduleActivity::class.java)
                 startActivity(ScheduleIntent)

             }
             R.id.nav_password -> {
                 //label.text="Password"

             }*/
            R.id.nav_signout -> {
                Login.relogin("login out successful ",this)
            }
        }
        val drawerLayout: DrawerLayout = findViewById(R.id.drawer_layout)
        drawerLayout.closeDrawer(GravityCompat.START)
        return true
    }



}

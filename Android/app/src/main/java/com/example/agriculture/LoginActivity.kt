package com.example.agriculture


import android.content.Context
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Toast
import android.view.View;
import kotlinx.android.synthetic.main.activity_login.*
import com.android.volley.toolbox.JsonObjectRequest
import org.json.JSONObject
import android.content.Intent
import android.content.pm.ActivityInfo
import com.android.volley.*
import com.example.agriculture.model.RResponse

class LoginActivity: AppCompatActivity()  {
    lateinit var req:RequestMethod
    lateinit var context:Context
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setRequestedOrientation (ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);

        context=this
        //  Fixed Portrait orientation

        if(intent.hasExtra("message")) {
            val msg: String = intent.getStringExtra("message")
            Toast.makeText(this, msg, Toast.LENGTH_LONG).show()
        }
        val token:String=Login.getToken(this);
        if(token=="")
            setContentView(R.layout.activity_login)
        else{
            val MainIntent = Intent(this, MainActivity::class.java)

            startActivity(MainIntent)
        }
        req=RequestMethod()
    }

    fun onButtonClickLogin(view: View) {
        val email=loginemail.text.toString();
        val password=password.text.toString()

        if(email==""){
            Toast.makeText(this, "Please fill email field", Toast.LENGTH_LONG).show()
            return
        }else{
            if (!android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches()){
                Toast.makeText(this, "Provided email not valid", Toast.LENGTH_LONG).show()
                return
            }
        }
        if(password==""){
            Toast.makeText(this, "Please fill password field", Toast.LENGTH_LONG).show()
            return
        }
        val res=login(email,password)

    }

    fun login(email:String,password:String) {

        // Post parameters
        // Form fields and values

        val params = HashMap<String, String>()
        params["email"] = email
        params["password"] = password
        val resp=req.postRequest(this,"login",params,false, object : VolleyCallback {
            override fun onSuccessResponse(resp: RResponse,context:Context) {
                if(resp.error=="") {
                    try {

                        Toast.makeText(context, "User Login Successfully", Toast.LENGTH_SHORT).show()
                        val MainIntent = Intent(context, MainActivity::class.java)
                        startActivity(MainIntent)
                      var task = FeedReaderDbHelper(context)
                        val token: String = JSONObject(resp.json).getJSONObject("success").getString("token");
                        val flag: Boolean = (task as FeedReaderDbHelper).addTask(token)
                        if (flag) {
                            val MainIntent = Intent(context, MainActivity::class.java)
                            startActivity(MainIntent)
                        } else {
                            msg.text = "Something go wrong in dealing with token"
                        }
                    } catch (e: Exception) {

                        if(resp.code==-1){
                            msg.text = "username or password is wrong"
                        }
                    }
                }else{
                    msg.text = "Something go wrong in dealing with token "+resp.error
                }
            }
        });
    }

}



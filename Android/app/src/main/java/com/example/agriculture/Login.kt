package com.example.agriculture

import android.app.DownloadManager
import android.content.Context
import android.content.Intent
import com.example.agriculture.model.RResponse
import kotlinx.android.synthetic.main.nav_header_main.*
import org.json.JSONObject
import kotlin.contracts.contract
import android.R
import android.app.Activity
import android.widget.TextView



public class Login {
    companion object {
        val statusPATH="details"
        public fun relogin(msg: String, context: Context) {
            var task = FeedReaderDbHelper(context)
            var flag: Boolean = task.deleteTask()
            if (flag) {
                val intent = Intent(context, LoginActivity::class.java)
                intent.putExtra("message", msg);
                context.startActivity(intent)
            }
        }

        public fun getToken(context: Context):String{
            var task=FeedReaderDbHelper(context)
            var token=task.getTask()
            return token
        }

        public fun getStatus(context: Context){
            var req: RequestMethod=RequestMethod()
            var outresp:RResponse= RResponse("","",0);
            req.getRequest(context,statusPATH, object : VolleyCallback {
                override fun onSuccessResponse(resp: RResponse, context: Context) {
                    if(resp.error!=""){
                            (context as Activity).status_msg.text=resp.error;
                    }else {
                        try {
                            var userEmail: String? = JSONObject(resp.json).getJSONObject("success").getString("email");
                            var userName: String? = JSONObject(resp.json).getJSONObject("success").getString("name");
                            (context as Activity).loginemail.text = userEmail
                            (context as Activity).name.text = userName
                            (context as Activity).status_msg.text="Online"
                        } catch (e: Exception) {
                            (context as Activity).name.text = "Something go wrong in get token"
                        }
                    }
                }
            });
        }
    }
}
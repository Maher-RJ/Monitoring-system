package com.example.agriculture

import android.content.Context
import com.android.volley.*
import com.android.volley.toolbox.StringRequest
import com.example.agriculture.model.RResponse

interface VolleyCallback {
    fun onSuccessResponse(result: RResponse,context: Context)
}

class RequestMethod {
    public val url: String = "http://192.168.0.34:8000/api/" //Put your ip adress of laravel server
    public fun getRequest(context: Context, path: String,callback:VolleyCallback ) {
        var resp: RResponse = RResponse("", "", 0);
        val request = object : StringRequest(Request.Method.GET, url + path,
            Response.Listener { response ->
                try {
                    resp.json = response.toString()
                } catch (e: Exception) {
                    resp.error = "error in response"
                }
                callback.onSuccessResponse(resp,context);
            }, Response.ErrorListener { error ->
                // Error in request
                // Error in request

                if (error is NetworkError) {
                    resp.error = "Network error"
                } else if (error is ServerError) {
                    //handle if server error occurs with 5** status code
                    resp.error = "Server error"
                } else if (error is AuthFailureError) {
                    //handle if authFailure occurs.This is generally because of invalid credentials
                    resp.code = -1
                    resp.error = "Token Problem"
                } else if (error is ParseError) {
                    //handle if the volley is unable to parse the response data.
                } else if (error is NoConnectionError) {
                    //handle if no connection is occurred
                    resp.error = "App offline"
                } else if (error is TimeoutError) {
                    //handle if socket time out is occurred.
                    resp.error = "No response"
                }
                callback.onSuccessResponse(resp,context);
            }) {
            override fun getHeaders(): Map<String, String> {
                val headers = HashMap<String, String>()
                headers.put("Authorization", "Bearer " + Login.getToken(context))
                headers.put("Accept", "application/json")
                return headers
            }
        }
        // Volley request policy, only one time request to avoid duplicate transaction
        request.retryPolicy = DefaultRetryPolicy(
            DefaultRetryPolicy.DEFAULT_TIMEOUT_MS,
            // 0 means no retry
            2, // DefaultRetryPolicy.DEFAULT_MAX_RETRIES = 2
            1f // DefaultRetryPolicy.DEFAULT_BACKOFF_MULT
        )
        // Add the volley post request to the request queue
        VolleySingleton.getInstance(context).addToRequestQueue(request)

    }

    public fun postRequest(context: Context, path: String, params: HashMap<String, String>, auth: Boolean,callback:VolleyCallback ) {
        var resp: RResponse = RResponse("", "", 0)

        val request = object : StringRequest(Request.Method.POST, url + path,
            Response.Listener { response ->
                try {
                    resp.json = response.toString()
                } catch (e: Exception) {
                    resp.error = "error in response"
                }
                callback.onSuccessResponse(resp,context);
            }, Response.ErrorListener { error ->
                // Error in request
                // Error in request

                if (error is NetworkError) {
                    resp.error = "Network error"
                } else if (error is ServerError) {
                    //handle if server error occurs with 5** status code
                    resp.error = "Server error"
                } else if (error is AuthFailureError) {
                    //handle if authFailure occurs.This is generally because of invalid credentials
                    resp.code = -1
                    resp.error = "Token Problem"
                } else if (error is ParseError) {
                    //handle if the volley is unable to parse the response data.
                } else if (error is NoConnectionError) {
                    //handle if no connection is occurred
                    resp.error = "App offline"
                } else if (error is TimeoutError) {
                    //handle if socket time out is occurred.
                    resp.error = "No response"
                }
                callback.onSuccessResponse(resp,context);
            }) {
            override fun getParams(): Map<String, String> {
                return params
            }

            override fun getHeaders(): Map<String, String> {
                val headers = HashMap<String, String>()
                if (auth)
                    headers.put("Authorization", "Bearer " + Login.getToken(context))

                headers.put("Accept", "application/json")
                return headers
            }
        }
        // Volley request policy, only one time request to avoid duplicate transaction
        request.retryPolicy = DefaultRetryPolicy(
            DefaultRetryPolicy.DEFAULT_TIMEOUT_MS,
            // 0 means no retry
            2, // DefaultRetryPolicy.DEFAULT_MAX_RETRIES = 2
            1f // DefaultRetryPolicy.DEFAULT_BACKOFF_MULT
        )
        // Add the volley post request to the request queue
        VolleySingleton.getInstance(context).addToRequestQueue(request)
    }
}
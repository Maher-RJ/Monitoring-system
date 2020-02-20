package com.example.agriculture.model

import org.json.JSONObject

class RResponse(json: String,error: String,code:Int) {
    public var json: String? = json
    public var error: String? = error
    public var code:Int?=code
}
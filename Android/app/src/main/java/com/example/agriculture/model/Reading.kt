package com.example.agriculture.model

import org.json.JSONObject

class Reading(json: String) : JSONObject(json) {
    val name: String? = this.optString("name")
    val wh: String? = this.optString("wh")
    val wt: String? = this.optString("wt")
    val sh: String? = this.optString("sh")
    val st: String? = this.optString("st")
    val light: String? = this.optString("light")
    val ph: String? = this.optString("ph")
    val at: String? = this.optString("at")
}
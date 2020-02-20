package com.example.agriculture.model

import org.json.JSONObject

class Node(json: String) : JSONObject(json) {
    val name: String? = this.optString("name")
    val mac: String? = this.optString("mac")
    val status: String? = this.optString("status")
    val at: String? = this.optString("created_at")
}
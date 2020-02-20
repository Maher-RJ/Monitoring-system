package com.example.agriculture.adapter
import android.content.Context
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.BaseAdapter
import android.widget.TextView
import com.example.agriculture.R
import com.example.agriculture.model.Node
import com.example.agriculture.model.Reading

class ReadingAdapter(context: Context, readings: List<Reading>?): BaseAdapter() {
    val context = context
    val readings = readings

    override fun getView(position: Int, convertView: View?, parent: ViewGroup?): View {
        val readingView: View
        val holder : ViewHolder

        if (convertView == null) {
            readingView = LayoutInflater.from(context).inflate(R.layout.reading_list_item, null)
            holder = ViewHolder()
            holder.itemName = readingView.findViewById(R.id.itemName)
            holder.itemSoil = readingView.findViewById(R.id.itemSoil)
            holder.itemSoil2 = readingView.findViewById(R.id.itemSoil2)
            holder.itemWeather = readingView.findViewById(R.id.itemWeather)
            holder.itemWeather2 = readingView.findViewById(R.id.itemWeather2)
            holder.itemLight = readingView.findViewById(R.id.itemLight)
            holder.itemPH = readingView.findViewById(R.id.itemPH)
            //holder.itemWind = readingView.findViewById(R.id.itemWind)
            holder.itemAt = readingView.findViewById(R.id.itemAt)
            readingView.tag = holder
        } else {
            holder = convertView.tag as ViewHolder
            readingView = convertView
        }
        if (readings != null) {
            val reading = readings[position]
            holder.itemName?.text = "Node Name: " + reading.name
            holder.itemSoil?.text = "SoilTemp "+reading.st
            holder.itemSoil2?.text = "Moisture "+" \t "+reading.sh
            holder.itemWeather?.text = "Humidity " + reading.wh
            holder.itemWeather2?.text = "AirTemp "+reading.wt
            holder.itemLight?.text = "Light: "+reading.light +""
            holder.itemPH?.text = "pH: "+reading.ph
            holder.itemAt?.text = "        \tSample Time: "+reading.at
        }else{
            println("region: null")
        }
        return readingView
    }

    override fun getItem(position: Int): Any {
        if (readings != null) {
            return readings[position]
        }
        return ""
    }

    override fun getItemId(position: Int): Long {
        return 0
    }

    override fun getCount(): Int {
        if (readings != null) {
            return readings.count()
        }
        return 0
    }

    private class ViewHolder {
        var itemSoil2: TextView? = null
        var itemName: TextView? = null
        var itemSoil: TextView? = null
        var itemWeather: TextView? = null
        var itemWeather2: TextView? = null
        var itemLight: TextView? = null
        //var itemWind: TextView? = null
        var itemPH: TextView? = null
        var itemAt: TextView? = null

    }
}
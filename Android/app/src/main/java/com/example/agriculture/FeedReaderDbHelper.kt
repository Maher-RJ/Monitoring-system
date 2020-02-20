package com.example.agriculture

import android.content.ContentValues
import android.content.Context
import android.database.Cursor
import android.database.sqlite.SQLiteConstraintException
import android.database.sqlite.SQLiteDatabase
import android.database.sqlite.SQLiteException
import android.database.sqlite.SQLiteOpenHelper

class FeedReaderDbHelper(context: Context) : SQLiteOpenHelper(context, DATABASE_NAME, null, DATABASE_VERSION) {
    override fun onCreate(db: SQLiteDatabase) {
        val CREATE_TABLE = "CREATE TABLE token (" +
                "id INTEGER PRIMARY KEY," +
                "token  TEXT);"
        db.execSQL(CREATE_TABLE)
    }

    override fun onUpgrade(db: SQLiteDatabase, oldVersion: Int, newVersion: Int) {
        // This database is only a cache for online data, so its upgrade policy is
        // to simply to discard the data and start over
    }

    override fun onDowngrade(db: SQLiteDatabase, oldVersion: Int, newVersion: Int) {
    }

    @Throws(SQLiteConstraintException::class)
    public fun addTask(token:String): Boolean {
        val db = this.writableDatabase
        val values = ContentValues()
        values.put("token",token )
        val _success = db.insert("token", null, values)
        db.close()
        return (Integer.parseInt("$_success") != -1)
    }

    public fun getTask(): String {

        val db = writableDatabase
        val selectQuery = "SELECT  * FROM token order by id desc limit 1"
        var token: String = ""
        try {
            val cursor = db.rawQuery(selectQuery, null)
            if (cursor.moveToNext()) {
                token = cursor.getString(cursor.getColumnIndex("token"))
            }
            cursor.close()
        } catch (e: Exception) {
        }
        return token;
    }

    public fun deleteTask(): Boolean {
        val db = this.writableDatabase
        val _success = db.delete("token",  "id>0",null).toLong()
        db.close()
        return Integer.parseInt("$_success") != -1
    }

    companion object {
        // If you change the database schema, you must increment the database version.
        val DATABASE_VERSION = 1
        val DATABASE_NAME = "app.sqlite"
    }

}
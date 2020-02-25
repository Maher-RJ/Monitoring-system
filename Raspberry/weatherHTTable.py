from db import db

class weatherHTTable(db):
    @staticmethod
    def insert(node_id,t, h,stamp):
        sql_insert_query = "INSERT INTO `weather_ht` (`node_id`, `humidity`, `temperature`,`stamp`) VALUES (%d,%f,%f,%d)"%(node_id,h,t,stamp)
        with db.con:
            cur = db.con.cursor()
            cur.execute(sql_insert_query)
            version = cur.fetchone()

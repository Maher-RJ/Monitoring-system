from db import db
from datetime import datetime


class phTable(db):
    @staticmethod
    def insert(node_id,l,stamp):
        dt_object = datetime.fromtimestamp(stamp)
        sql_insert_query = "INSERT INTO `ph` (`node_id`, `ph`, `stamp`) VALUES (%d,%d,%d)" %(node_id,l,stamp)
        with db.con:
            cur = db.con.cursor()
            cur.execute(sql_insert_query)
            version = cur.fetchone()

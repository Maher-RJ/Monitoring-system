from db import db

class phTable(db):
    @staticmethod
    def insert(node_id,l,stamp):
        sql_insert_query = "INSERT INTO `ph` (`node_id`, `ph`, `stamp`) VALUES (%d,%d,%d)"%(node_id,l,stamp)
        with db.con:
            cur = db.con.cursor()
            cur.execute(sql_insert_query)
            version = cur.fetchone()



import mysql.connector
from datetime import time

def connect_db():
    return mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="medical"
    )

def insert_news(news):
    conn = connect_db()
    cursor = conn.cursor()

    sql = "insert into news (title, text, date) values (%s, %s, %s)"

    for n in news:
        values = (n["title"], n["text"], n["date"])
        cursor.execute(sql, values)

    conn.commit()
    cursor.close()
    conn.close()

    print("Данные успешно вставлены")

def insert_specialists(specialists):
    conn = connect_db()
    cursor = conn.cursor()

    sql = "insert into specialists (photo, name, speciality) values (%s, %s, %s)"

    for s in specialists:
        values = (s["photo"], s["name"], s["speciality"])
        cursor.execute(sql, values)

    conn.commit()
    cursor.close()
    conn.close()

    print("Данные успешно вставленыё")

def insert_schedule():
    conn = connect_db()
    cursor = conn.cursor()

    sql = "insert into schedule (doctor_id, day_of_week, work_from, work_to) values (%s, %s, %s, %s)"
    doctor_patterns = {
        1: {"days": [1, 2, 3, 4, 5], "work_time": (time(8, 0), time(14, 0))},
        2: {"days": [1, 3, 5], "work_time": (time(13, 0), time(19, 0))},
        3: {"days": [2, 4, 6], "work_time": (time(10, 30), time(18, 30))},
        4: {"days": [1, 2, 3, 4], "work_time": (time(6, 0), time(12, 0))},
        5: {"days": [5, 6, 0], "work_time": (time(14, 0), time(20, 0))},
        6: {"days": [1, 2, 3, 4, 5], "work_time": (time(9, 30), time(17, 30))},
        7: {"days": [1, 3, 5, 0], "work_time": (time(8, 0), time(14, 0))},    
        8: {"days": [2, 4, 6], "work_time": (time(11, 0), time(17, 0))},      
        9: {"days": [1, 2, 4, 5], "work_time": (time(7, 30), time(15, 30))},  
        10: {"days": [3, 6, 0], "work_time": (time(8, 0), time(12, 0))},      
        11: {"days": [1, 2, 3, 4, 5, 6], "work_time": (time(10, 0), time(16, 0))},
    }


    for d_id in range(1, 12):
        pattern = doctor_patterns[d_id]
        work_from, work_to = pattern["work_time"]

        days = pattern["days"]

        for day in days:
            values = (d_id, day, work_from, work_to)
            cursor.execute(sql, values)

    conn.commit()
    cursor.close()
    conn.close()


if __name__ == "__main__":
    insert_schedule()
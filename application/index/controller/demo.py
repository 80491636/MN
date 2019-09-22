#导入需要的类库
import requests
import sys, os, re, time, random, json
import pymysql
import configparser
from bs4 import BeautifulSoup

# header = {
#     'Referer': 'https://www.tp8.com/',
#     'Sec-Fetch-Mode': 'no-cors',
#     'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36',
# }
# r = requests.get("https://img.tp8.com/Pics/2019/0917/c_33/01.jpg",headers=header)
# print(r.status_code)
# 连接数据库
connect = pymysql.Connect(
    host = 'localhost',
    port = 3306,
    user = 'root',
    passwd = '123456',
    db = 'MN',
    charset = 'utf8'
)
# 获取游标
cursor = connect.cursor()

sql = "SELECT * FROM taglist where id > 0"
cursor.execute(sql)
for row in cursor.fetchall():
    id = row[0]
    img = row[4]
    print(id,img)

    matchObj = re.match( r"https://img.tp8.com(.*)", img, re.M|re.I)
    
    if matchObj:
        img = matchObj.group(1)
    else:
        break
    # print(img)
    # exit()
    # 修改数据
    s = "UPDATE taglist SET img = '%s' WHERE id = '%d' "
    data = (img.strip(), id)

    cursor.execute(s % data)
    connect.commit()
    print('成功修改', cursor.rowcount, '条数据')



connect.close()

from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
import time

username = "tudor123"
password = "boitor"

edgeBrowser = webdriver.Edge()
fail_output = "<html><head></head><body>3Incorrect  password!</body></html>"
edgeBrowser.get('http://localhost/proiect/login/Proiect_index.html')
username_field = edgeBrowser.find_element(By.NAME, "username")
username_field.send_keys(username)
password_field = edgeBrowser.find_element(By.NAME, "password")
password_field.send_keys(password)
password_field.send_keys(Keys.ENTER)
output = edgeBrowser.page_source

if output == fail_output:
    print("failed")
else:
    print("passed")

time.sleep(2)

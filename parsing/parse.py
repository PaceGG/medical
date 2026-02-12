import requests
from bs4 import BeautifulSoup
import utils


def parse_news():
    url="https://mckonsilium.ru/news/"

    response = requests.get(url)
    soup = BeautifulSoup(response.text, "html.parser")

    items = soup.find_all("div", class_="body-info")

    news = []

    for item in items:
        title = item.find("a").text.strip()
        content = item.find("p").text.strip()
        date = item.find("span", class_="date").text.strip()

        news.append({
            "title": title,
            "text": content,
            "date": date
        })

    print("Новости успешрно извлечены")

    return news

def parse_specialists():
    url="https://mckonsilium.ru/staff/vrachi/"

    response = requests.get(url)
    soup = BeautifulSoup(response.text, "html.parser")

    items = soup.find_all("div", class_="wrap")

    specialists = []

    for item in items:
        photo = item.find("img", class_="img-responsive")
        name = item.select_one('div.title a')
        speciality = item.select_one('div.post')

        if photo is None:
            continue
        if name is None:
            continue
        if speciality is None:
            continue

        photo = photo.get("src")
        photo = "https://mckonsilium.ru" + photo

        name = name.text.strip()

        speciality = speciality.text

        specialists.append({
            "photo": photo,
            "name": name,
            "speciality": speciality
        })

    print("Данные о специалистах успешно извлечены")

    return utils.remove_duplicates(specialists)


if __name__ == "__main__":
    print(parse_specialists())
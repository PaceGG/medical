import parse
import db

def fill_news():
    news = parse.parse_news()
    db.insert_news(news)

def fill_specialists():
    specialists = parse.parse_specialists()
    db.insert_specialists(specialists)

if __name__ == "__main__":
    fill_specialists()
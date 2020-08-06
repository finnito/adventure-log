#!/Users/finnlesueur/.pyenv/shims/python3

import pymysql.cursors
from dotenv import load_dotenv
from pathlib import Path
import geojson
import time
import os


def main():
    # Load the .env file
    env_path = Path('.') / '.env'
    load_dotenv(dotenv_path=env_path)

    # Load the DOC Huts geojson
    with open("DOC_Huts.geojson") as f:
        gj = geojson.load(f)

    # Connect to MySQL
    connection = pymysql.connect(host=os.getenv("DB_HOST"),
                                 user=os.getenv("DB_USERNAME"),
                                 password=os.getenv("DB_PASSWORD"),
                                 db=os.getenv("DB_DATABASE"),
                                 charset='utf8mb4',
                                 cursorclass=pymysql.cursors.DictCursor)

    for feature in gj["features"]:
        with connection.cursor() as cursor:
            # Create a new record
            sql = """
                INSERT INTO
                `adventure_log_places_places` (
                    `created_at`,
                    `created_by_id`,
                    `name`,
                    `name_slug`,
                    `place_slug`,
                    `fid`,
                    `place`,
                    `region`,
                    `facilities`,
                    `static_link`,
                    `asset_id`,
                    `date_loaded_to_gis`,
                    `latitude`,
                    `longitude`,
                    `thumbnail`
                ) VALUES (
                    %s,
                    %s,
                    %s,
                    %s,
                    %s,
                    %s,
                    %s,
                    %s,
                    %s,
                    %s,
                    %s,
                    %s,
                    %s,
                    %s,
                    %s
                )"""
            cursor.execute(sql, (
                    time.strftime('%Y-%m-%d %H:%M:%S'),
                    1,
                    feature["properties"]["name"],
                    slugify(feature["properties"]["name"]),
                    slugify(feature["properties"]["place"]),
                    int(feature["properties"]["FID"]),
                    feature["properties"]["place"],
                    feature["properties"]["region"],
                    feature["properties"]["facilities"],
                    feature["properties"]["staticLink"],
                    int(feature["properties"]["assetId"]),
                    feature["properties"]["dateLoadedToGIS"],
                    float(feature["geometry"]["coordinates"][1]),
                    float(feature["geometry"]["coordinates"][0]),
                    feature["properties"]["introductionThumbnail"]
                )
            )
            connection.commit()

def slugify(string):
    if string is None:
        string = ""
    non_url_safe = ['"', '#', '$', '%', '&', '+',
                        ',', '/', ':', ';', '=', '?',
                        '@', '[', '\\', ']', '^', '`',
                        '{', '|', '}', '~', "'"]
    translate_table = {ord(char): u'' for char in non_url_safe}
    slug = string.translate(translate_table)
    slug = slug.split()
    for count, value in enumerate(slug):
        slug[count] = value.lower()
    slug = '-'.join(slug)
    return slug

if __name__ == "__main__":
    main()

#!/Users/finnlesueur/.pyenv/shims/python3

import pymysql.cursors
import geojson
import time    

with open("DOC_Huts.geojson") as f:
    gj = geojson.load(f)

connection = pymysql.connect(host='localhost',
                             user='root',
                             password='cjbzxt(+B1Hk',
                             db='adventure_log',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)

non_url_safe = ['"', '#', '$', '%', '&', '+',
                    ',', '/', ':', ';', '=', '?',
                    '@', '[', '\\', ']', '^', '`',
                    '{', '|', '}', '~', "'"]

for feature in gj["features"]:
    print(feature["properties"]["name"])
    translate_table = {ord(char): u'' for char in non_url_safe}
    slug = feature["properties"]["name"].translate(translate_table)
    slug = slug.split()
    for i in range(0, len(slug)):
        slug[i] = slug[i].lower()
    slug = u'-'.join(slug) + "-" + str(feature["properties"]["FID"])

    tp = (
        feature["properties"]["name"],
        slug,
        int(feature["properties"]["FID"]),
        feature["properties"]["place"],
        feature["properties"]["region"],
        feature["properties"]["facilities"],
        feature["properties"]["staticLink"],
        int(feature["properties"]["assetId"]),
        feature["properties"]["dateLoadedToGIS"],
        float(feature["geometry"]["coordinates"][0]),
        float(feature["geometry"]["coordinates"][1]),
        feature["properties"]["introductionThumbnail"]
    )

    print(tp)
    with connection.cursor() as cursor:
        # Create a new record
        sql = """
            INSERT INTO
            `adventure_log_places_places` (
                `created_at`,
                `name`,
                `slug`,
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
                %s
            )"""
        cursor.execute(sql, (
                time.strftime('%Y-%m-%d %H:%M:%S'),
                feature["properties"]["name"],
                slug,
                int(feature["properties"]["FID"]),
                feature["properties"]["place"],
                feature["properties"]["region"],
                feature["properties"]["facilities"],
                feature["properties"]["staticLink"],
                int(feature["properties"]["assetId"]),
                feature["properties"]["dateLoadedToGIS"],
                float(feature["geometry"]["coordinates"][0]),
                float(feature["geometry"]["coordinates"][1]),
                feature["properties"]["introductionThumbnail"]
            )
        )
        connection.commit()

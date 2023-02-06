
random_town = 0
town_name = "ASDF"
city = "thorp"
city_types = {
    "thorp": {
        "houses": range(80, 100)/4,
        "size": 0
    },
    "village": {
        "houses": range(100, 200)/4,
        "size": 0
    },
    "town": {
        "houses": range(200, 300)/4,
        "size": 1
    },
    "city": {
        "houses": range(300, 400)/4,
        "size": 2
    },
    "Big city": {
        "houses": range(400, 100)/5,
        "size": 3
    },
}
buildings = [
    "tavern",
    "blacksmith",
    "woodworker",
    "cobbler",
    "general_trade",
    "market",
    "church",
    "cemetary",
    "farm",
    "tailor",
    "orchard",
    "mine",
    "mill",
    "town_hall",
    "gallows",
    "pond_creek",
    "magic_shop",
]
buildingset = {}
building_count = 0
generated_map = []
map_width = 0
map_height = 0
for building in buildings:
    buildingset[building] = range(0, city_types[city]["size"])
    building_count = building_count + buildingset[building]


map_width = (building_count/2) + (building_count/4)
map_height = (building_count/2) + (building_count/4)

for (building, value) in buildingset:
    not_set = True
    if value > 0:
        while not_set:
            x_axis = range(0, map_width)
            y_axis = range(0, map_height)
            if generated_map[x_axis][y_axis] == "":
                generated_map[x_axis][y_axis] = building
                not_set = False

for x in range(0, city_types[city]["houses"]):
    not_set = True
    while not_set:
        x_axis = range(0, map_width)
        y_axis = range(0, map_height)
        if generated_map[x_axis][y_axis] == "":
            generated_map[x_axis][y_axis] = "House"
            not_set = False


print(f"The layout for {town_name}\n\n")
# Head columns
for x in range(0, map_width):
    if x > 0:
        print(x)

for height in range(0, map_height):
    print(f"\r\n{x} ")

    for width in range(0, map_width):
        print(f"{generated_map[width][height]}")

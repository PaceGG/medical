def remove_duplicates(data: list[dict]) -> list[dict]:
    seen = set()
    result = []

    for item in data:
        key = tuple(sorted(item.items()))

        if key not in seen:
            seen.add(key)
            result.append(item)

    return result


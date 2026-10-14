import json
import re
from pathlib import Path

# Verified address for Antalya Airport Terminal 2
NEW_ADDRESS = {
    "@type": "PostalAddress",
    "streetAddress": "Antalya Havalimanı Dış Hatlar Terminali 2",
    "addressLocality": "Yeşilköy Mahallesi, Muratpaşa",
    "addressRegion": "Antalya",
    "postalCode": "07230",
    "addressCountry": "TR"
}

NEW_ADDRESS_JSON = json.dumps(NEW_ADDRESS, ensure_ascii=False)

def find_and_replace_address(content: str, new_address_json: str) -> str:
    pattern = re.compile(
        r'("address"\s*:\s*)\{.*?"@type"\s*:\s*"PostalAddress".*?\}',
        re.DOTALL
    )
    def replacer(match):
        return match.group(1) + new_address_json
    new_content, count = pattern.subn(replacer, content)
    if count == 0:
        print("  ⚠ Warning: Could not find the PostalAddress block.")
        return content
    print("  ✅ Updated address block.")
    return new_content

def main():
    index_path = Path("index.html")
    if not index_path.exists():
        print("❌ Error: index.html not found.")
        return

    content = index_path.read_text(encoding="utf-8")
    updated = find_and_replace_address(content, NEW_ADDRESS_JSON)

    if updated != content:
        backup = index_path.with_suffix(".html.bak")
        backup.write_text(content, encoding="utf-8")
        print(f"Backup: {backup}")
        index_path.write_text(updated, encoding="utf-8")
        print("✅ index.html updated.")
        print("\nNext: upload the file and re-run the Rich Results Test.")
    else:
        print("No changes made.")

if __name__ == "__main__":
    main()
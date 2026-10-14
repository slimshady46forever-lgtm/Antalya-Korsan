#!/bin/bash

# The file you want to modify
FILE="index.html"

# Check if the file exists
if [ ! -f "$FILE" ]; then
    echo "Error: $FILE not found. Please run this script in the root directory of your website."
    exit 1
fi

# Create a backup just in case
cp "$FILE" "$FILE.bak"
echo "Backup created as $FILE.bak"

# Update the lines to point to logo.ico and change the type to image/x-icon
# This targets lines containing rel="icon", rel="shortcut icon", or rel="apple-touch-icon"
sed -i '/rel="icon"/ s|logo\.png|logo.ico|g; s|type="image/png"|type="image/x-icon"|g' "$FILE"
sed -i '/rel="shortcut icon"/ s|logo\.png|logo.ico|g; s|type="image/png"|type="image/x-icon"|g' "$FILE"
sed -i '/rel="apple-touch-icon"/ s|logo\.png|logo.ico|g' "$FILE"

echo "Successfully updated $FILE to use logo.ico"

# --- OPTIONAL: Uncomment the lines below to automatically commit and push to GitHub ---
# echo "Pushing changes to GitHub..."
# git add "$FILE"
# git commit -m "Update favicon to logo.ico"
# git push origin main  # Change 'main' to 'master' if your default branch is master
# echo "Changes pushed!"

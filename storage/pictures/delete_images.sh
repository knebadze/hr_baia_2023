#!/bin/bash
# This script deletes files with the same base name but different extensions in the current directory.

# Loop through all files with the .JPG extension
for file in *.JPG; do
  # Extract the base name (without extension)
  base_name="${file%.JPG}"
  
  # Delete both .JPG and .jpg files with this base name
  rm -v "${base_name}.JPG" "${base_name}.jpg"
done

# Loop through all files with the .jpg extension (in case there were no matching .JPG files)
for file in *.jpg; do
  # Extract the base name (without extension)
  base_name="${file%.jpg}"
  
  # Delete both .jpg and .JPG files with this base name
  rm -v "${base_name}.jpg" "${base_name}.JPG"
done

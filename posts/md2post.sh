#!/usr/bin/env sh

# Get the filename without the extension
infn="$1"

basename="$(basename "$infn")"

outfn="$(echo "$basename" | sed 's/.md$//' )"

pandoc --from markdown "$infn" --to html -o "${outfn}.html"

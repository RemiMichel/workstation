
for file in /etc/nginx/templates/* ; do

  filename=$(basename -- "$file")
  filename="${filename%.*}"

  envsubst < $file > /etc/nginx/conf.d/$filename.conf

done;

nginx -g "daemon off;"
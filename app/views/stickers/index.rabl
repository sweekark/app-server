collection @stickers 
attributes :_id, :name
node :user_name do
|c| c.images[0].image.url
end

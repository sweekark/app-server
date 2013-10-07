collection @routes
attributes :id, :name
child(:from) { attributes :name }
child :images do |image|
  attributes :image_file_name
  node :path do |u|
    u.image.url
  end
end
#node(:images) { |image| image.image_url?() }

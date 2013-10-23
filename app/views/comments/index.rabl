collection @comments 
attributes :activity
#child(:activity) {attributes :type}
node :user_name do
|c| c.user.name
end

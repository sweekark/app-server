class Comment
  include Mongoid::Document
  field :content, type: String
	belongs_to :user
belongs_to :route
end
class content
content_types = {0:"logo",1:"image",2:"video",3:"text"}
field :type, type: int
field :data, type: string
end


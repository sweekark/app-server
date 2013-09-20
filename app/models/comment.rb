class Comment
  include Mongoid::Document
  field :content, type: String
	belongs_to :user
	belongs_to :route
end
=begin
class content
#content_types = {"logo","image","video","text"}
field :type, type: int
field :data, type: string
end
=end

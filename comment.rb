class Comment
  include Mongoid::Document
  field :content, type: String
belongs_to :user
end

class Content
  include Mongoid::Document
  field :data, type: String
  field :references, type: String
  field :comment, type: String
end

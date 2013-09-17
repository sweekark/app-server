class User
  include Mongoid::Document
  field :name, type: String
  field :loc, type: Hash
embeds_one :label
has_many :comments
end

class Label
  include Mongoid::Document
  field :name, type: String
  embedded_in :user
end


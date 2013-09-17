class User
  include Mongoid::Document
  field :name, type: String
  field :loc, type: Hash
  embeds_one :auth
  has_many :comments
end

class Auth
  include Mongoid::Document
  field :name, type: String
  embedded_in :user
end


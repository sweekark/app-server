class User
  include Mongoid::Document
  field :name, type: String
  embeds_one :auth
  has_many :comments
end

class Auth
  include Mongoid::Document
  field :name, type: String
  field :type, type: String
  embedded_in :user
end

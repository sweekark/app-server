class User
  include Mongoid::Document
  field :unique_android_key, type: String
  embeds_one :auth
  embeds_many :follows
  has_many :comments
end

class Auth
  include Mongoid::Document
  field :name, type: String
  field :type, type: String
  embedded_in :user
end

class Follow
  include Mongoid::Document
  field :route_id, type: String
  embedded_in :user
end




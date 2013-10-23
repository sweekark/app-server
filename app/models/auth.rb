class Auth
  include Mongoid::Document
  field :authid, type: String
  field :name, type: String
  field :provider, type: String
  embedded_in :user
end

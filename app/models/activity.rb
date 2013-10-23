class Activity
  include Mongoid::Document
  field :feed, type: Array
	belongs_to :user
	belongs_to :route
end

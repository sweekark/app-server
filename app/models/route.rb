class Route
  include Mongoid::Document
  field :name, type: String
  field :priority, type: Integer
  field :status, type: Boolean , default: ->{ true } 
	default_scope where(status: true)
  embeds_one :from
  embeds_many :to
  has_many :images
  has_many :comments
  has_many :travel_times

def self.getRoute
	Route.all().each do |r|
	r.travel_times.where({"travel_times.date" => Date.today})
	r.images.where({"images.date" => Date.today})
	end
end
end

class To
  include Mongoid::Document
  field :name, type: String
  field :display_name, type: String
  field :location, type: Array ,default: ->{ [11,12] }
embedded_in :route
  index({ location: "2d" })

end

class From
  include Mongoid::Document
  field :name, type: String
  field :display_name, type: String
  field :location, type: Array ,default: ->{ [12.937070,77.626605] } 

  index({ location: "2d" })
end

class Route
  include Mongoid::Document
  field :name, type: String
  embeds_one :from
  embeds_one :to
  embeds_many :image
  has_many :comments
end

class To
  include Mongoid::Document
  field :name, type: String

field :location, type: Array ,default: ->{ [11,12] }

  index({ location: "2d" })

end

class From
  include Mongoid::Document
  field :name, type: String
field :location, type: Array ,default: ->{ ["12.937070","77.626605"] } 

  index({ location: "2d" })
end

class Image
  include Mongoid::Document
  field :name, type: String
  field :location, type: String 
end

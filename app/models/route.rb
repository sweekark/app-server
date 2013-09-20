class Route
  include Mongoid::Document
  field :name, type: String
  embeds_one :from
  embeds_one :to
  has_many :images
  has_many :comments
def image_url
#     images.each do |image|
	Rails.logger.debug("treeeeeeeeee")
	Rails.logger.debug("results : #{image.image.url}")
	image.image.url
 #  end
   end

def as_json(options = nil)
    super(
	{ :include =>{ 
	:images => {:methods => [:image_url]}
	}
}.merge(options || {}))
  end
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
field :location, type: Array ,default: ->{ [12.937070,77.626605] } 

  index({ location: "2d" })
end

Route.includes(:images).each do |route|
  p route.images.first # Does not hit the database again.
end



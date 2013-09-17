class Route
  include Mongoid::Document
  embeds_one :from
  embeds_one :to
end

class To
  include Mongoid::Document
  field :name, type: String
end

class From
  include Mongoid::Document
  field :name, type: String
end

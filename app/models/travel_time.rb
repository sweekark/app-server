class TravelTime
  include Mongoid::Document
  field :route_id, type: String
  field :date, type: Date , default: ->{ Date.today }
  belongs_to :route
default_scope any_of({date: Date.today}, {date: Date.today-1} ).order_by(:date.desc)
	embeds_many :durations
end

class Duration
  include Mongoid::Document
field :time ,type: Time , default: ->{ Time.now }
field :value, type: String
embedded_in :travel_time
default_scope order_by(:time.desc)
end

collection @routes 
attributes :_id, :name
node :travel_times do |r| 
#extends "routes/index2.rabl"
 t =r.travel_times.where({"date" => Date.today} ) 
end

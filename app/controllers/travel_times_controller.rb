class TravelTimesController < ApplicationController
  # GET /travel_times
  # GET /travel_times.json
  def index
    @travel_times = TravelTime.all

    respond_to do |format|
      format.html # index.html.erb
      format.json { render json: @travel_times }
    end
  end

  # GET /travel_times/1
  # GET /travel_times/1.json
  def show
    @travel_time = TravelTime.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.json { render json: @travel_time }
    end
  end

  # GET /travel_times/new
  # GET /travel_times/new.json
  def new
    @travel_time = TravelTime.new

    respond_to do |format|
      format.html # new.html.erb
      format.json { render json: @travel_time }
    end
  end

  # GET /travel_times/1/edit
  def edit
    @travel_time = TravelTime.find(params[:id])
  end

  # POST /travel_times
  # POST /travel_times.json
  def create
  require 'rest-client'

  require 'rest-client'
  @routes = Route.all()
  @routes.each do |route|
   @travel_time = populateTravelTime(route)

  end
  respond_to do |format|
        if @travel_time.save
          format.html { redirect_to @travel_time, notice: 'Travel time was successfully created.' }
          format.json { render json: @travel_time, status: :created, location: @travel_time }
        else
          format.html { render action: "new" }
          format.json { render json: @travel_time.errors, status: :unprocessable_entity }
        end
      end
  end

  # PUT /travel_times/1
  # PUT /travel_times/1.json
  def update
    @travel_time = TravelTime.find(params[:id])

    respond_to do |format|
      if @travel_time.update_attributes(params[:travel_time])
        format.html { redirect_to @travel_time, notice: 'Travel time was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: "edit" }
        format.json { render json: @travel_time.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /travel_times/1
  # DELETE /travel_times/1.json
  def destroy
    @travel_time = TravelTime.find(params[:id])
    @travel_time.destroy

    respond_to do |format|
      format.html { redirect_to travel_times_url }
      format.json { head :no_content }
    end
  end
  def populateTravelTime(route)
    response = RestClient.get 'http://maps.googleapis.com/maps/api/distancematrix/json' ,
    {:params => {'origins' => 'sony world bangalore', 'destinations' => 'domlur bangalore','sensor' => 'false'}}
    puts response.code
    data = JSON.parse(response)
    @travel_time = TravelTime.find_or_create_by({:date => Date.today,:route_id => route._id})
    @duration = Duration.new({:time => Time.now,
     :value=>data['rows'][0]['elements'][0]['duration']['value']})
    @travel_time.durations.push(@duration)
    route.travel_times.push(@travel_time)
    return @travel_time
  end
end

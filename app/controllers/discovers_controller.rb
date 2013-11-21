class DiscoversController < ApplicationController
  # GET /discovers
  # GET /discovers.json
  def index
    @discovers = Discover.where("route_id" => params[:route_id])

    respond_to do |format|
      format.html # index.html.erb
      format.json { render json: @discovers }
    end
  end

  # GET /discovers/1
  # GET /discovers/1.json
  def show
    @discover = Discover.where("route_id" => params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.json { render json: @discover }
    end
  end

  # GET /discovers/new
  # GET /discovers/new.json
  def new
    @discover = Discover.new

    respond_to do |format|
      format.html # new.html.erb
      format.json { render json: @discover }
    end
  end

  # GET /discovers/1/edit
  def edit
    @discover = Discover.find(params[:id])
  end

  # POST /discovers
  # POST /discovers.json
  def create
    @route = Route.find(params[:discover][:route_id])
    @discover = Discover.new()
    @route.discovers.push(@discover)
	#@route.discover.build()
    @discover.images.build(params[:discover][:images]) 
    respond_to do |format|
      if @discover.save
        #format.html { redirect_to @discover, notice: 'Discover was successfully created.' }
        format.json { render json: @discover, status: :created, location: @discover }
      else
        #format.html { render action: "new" }
        format.json { render json: @discover.errors, status: :unprocessable_entity }
      end
    end
  end

  # PUT /discovers/1
  # PUT /discovers/1.json
  def update
    @discover = Discover.find(params[:id])

    respond_to do |format|
      if @discover.update_attributes(params[:discover])
        format.html { redirect_to @discover, notice: 'Discover was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: "edit" }
        format.json { render json: @discover.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /discovers/1
  # DELETE /discovers/1.json
  def destroy
    @discover = Discover.find(params[:id])
    @discover.destroy

    respond_to do |format|
      format.html { redirect_to discovers_url }
      format.json { head :no_content }
    end
  end
end

class FollowsController < ApplicationController
  # GET /follows
  # GET /follows.json
  def index
    @follows = User.find(params[:user_id]).follows
	@follow_routes = Array.new()
	@follows.each do |route|
		@follow_routes << route.route_id
	end 
	@routes = Route.find(@follow_routes)
      respond_to do |format|
      format.html # index.html.erb
      #format.json { render json: @routes }
      format.json { render "routes/index" }
    end
  end

  # GET /follows/1
  # GET /follows/1.json
  def show
    @follow = Follow.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.json { render json: @follow }
    end
  end

  # GET /follows/new
  # GET /follows/new.json
  def new
    @follow = Follow.new

    respond_to do |format|
      format.html # new.html.erb
      format.json { render json: @follow }
    end
  end

  # GET /follows/1/edit
  def edit
    @follow = Follow.find(params[:id])
  end

  # POST /follows
  # POST /follows.json
  def create
    @user = User.find(params[:user_id])
    @follow = Follow.new("route_id" => params[:route_id])
    @user.follows.push(@follow)

    respond_to do |format|
      if @user.save
        format.html { redirect_to @follow, notice: 'Follow was successfully created.' }
        format.json { render json: @follow, status: :created, location: @follow }
      else
        format.html { render action: "new" }
        format.json { render json: @follow.errors, status: :unprocessable_entity }
      end
    end
  end

  # PUT /follows/1
  # PUT /follows/1.json
  def update
    @follow = Follow.find(params[:id])

    respond_to do |format|
      if @follow.update_attributes(params[:follow])
        format.html { redirect_to @follow, notice: 'Follow was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: "edit" }
        format.json { render json: @follow.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /follows/1
  # DELETE /follows/1.json
  def destroy
    @follow = Follow.find(params[:id])
    @follow.destroy

    respond_to do |format|
      format.html { redirect_to follows_url }
      format.json { head :no_content }
    end
  end
end

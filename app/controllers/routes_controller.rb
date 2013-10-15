      class RoutesController < ApplicationController
      # GET /routes
      # GET /routes.json
        def index
          # get all routes for a given user id.
          # should be implemented to get for various users.
          @no_of_routes_per_page = 2
          @page_no = 1
          user_id = params[:user_id]
          Rails.logger.debug("results : #{user_id}")
	skip = (@page_no -1) * @no_of_routes_per_page		
         # @routes = TravelTimes.getRoutes()
        # @routes = Route.all().limit(@no_of_routes_per_page).skip(skip)
	#@routes = Route.find({"travel_time.data" : Date.today})
	#@routes = Route.where({"travel_times.date" => Date.today})
	@data = Route.getRoute
	@routes = Route.all()
          respond_to do |format|
            format.html # index.html.erb
           format.json { render "routes/index"}
            #format.json { render  json: @data }
          end
        end

      # GET /routes/1
      # GET /routes/1.json
      def show
        @route = Route.find(params[:id])
        respond_to do |format|
          format.html # show.html.erb
          format.json { render json: @route }
        end
      end

      # GET /routes/new
      # GET /routes/new.json
      def new
        @route = Route.new

        respond_to do |format|
          format.html # new.html.erb
          format.json { render json: @route }
        end
      end

      # GET /routes/1/edit
      def edit
        @route = Route.find(params[:id])
      end

      # POST /routes
      # POST /routes.json
      def create
        @route = Route.new(params[:route])
        @route.from = From.new(params[:route][:from])

        respond_to do |format|
          if @route.save
            format.html { redirect_to @route, notice: 'Route was successfully created.' }
            format.json { render json: @route, status: :created, location: @route }
          else
            format.html { render action: "new" }
            format.json { render json: @route.errors, status: :unprocessable_entity }
          end
        end
      end

      # PUT /routes/1
      # PUT /routes/1.json
      def update
        @route = Route.find(params[:id])

        respond_to do |format|
          if @route.update_attributes(params[:route])
            format.html { redirect_to @route, notice: 'Route was successfully updated.' }
            format.json { head :no_content }
          else
            format.html { render action: "edit" }
            format.json { render json: @route.errors, status: :unprocessable_entity }
          end
        end
      end

      # DELETE /routes/1
      # DELETE /routes/1.json
      def destroy
        @route = Route.find(params[:id])
        @route.destroy

        respond_to do |format|
          format.html { redirect_to routes_url }
          format.json { head :no_content }
        end
      end
    end

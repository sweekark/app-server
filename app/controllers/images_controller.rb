class ImagesController < ApplicationController
def index
end

    def index
        @images = Image.all()
        respond_to do |format|
        format.html # index.html.erb
        format.json { render json: @images }
    end
    end
    def new
    end

    def show
    @id = params[:id]
    @image = Image.find(@id)
#Rails.logger.debug("results : #{@images}")
    end

    def create
        #@route = Route.where(:_id => '52396d638f16021911000037').first
        @route = Route.where({}).first
    @image = Image.new(params[:image])
    @route.images = [@image]
    if @route.save
    redirect_to :action => :show, :id => @image.id
    end
    end
    end

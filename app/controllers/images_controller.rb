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
	end

	def create
@image = Image.new(params[:image])
	if @image.save
	redirect_to :action => :show, :id => @image.id
	end
	end
	end

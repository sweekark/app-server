class StickersController < ApplicationController
  # GET /stickers
  # GET /stickers.json
  def index
    @stickers = Sticker.all

    respond_to do |format|
      format.html # index.html.erb
      #format.json { render json: @stickers }
          format.json { render "stickers/index"}
    end
  end

  # GET /stickers/1
  # GET /stickers/1.json
  def show
    @sticker = Sticker.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.json { render json: @sticker }
    end
  end

  # GET /stickers/new
  # GET /stickers/new.json
  def new
    @sticker = Sticker.new

    respond_to do |format|
      format.html # new.html.erb
      format.json { render json: @sticker }
    end
  end

  # GET /stickers/1/edit
  def edit
    @sticker = Sticker.find(params[:id])
  end

  # POST /stickers
  # POST /stickers.json
  def create
    @sticker = Sticker.new()
    @sticker.images.build(params[:sticker][:images]) 
@sticker.name = params[:sticker][:name]
@sticker.display_name = params[:sticker][:display_name]

    respond_to do |format|
      if @sticker.save
        format.html { redirect_to @sticker, notice: 'Sticker was successfully created.' }
        format.json { render json: @sticker, status: :created, location: @sticker }
      else
        format.html { render action: "new" }
        format.json { render json: @sticker.errors, status: :unprocessable_entity }
      end
    end
  end

  # PUT /stickers/1
  # PUT /stickers/1.json
  def update
    @sticker = Sticker.find(params[:id])

    respond_to do |format|
      if @sticker.update_attributes(params[:sticker])
        format.html { redirect_to @sticker, notice: 'Sticker was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: "edit" }
        format.json { render json: @sticker.errors, status: :unprocessable_entity }
      end
    end
  end

  # DELETE /stickers/1
  # DELETE /stickers/1.json
  def destroy
    @sticker = Sticker.find(params[:id])
    @sticker.destroy

    respond_to do |format|
      format.html { redirect_to stickers_url }
      format.json { head :no_content }
    end
  end
end

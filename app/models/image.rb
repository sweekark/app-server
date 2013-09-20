class Image
	include Mongoid::Document
	include Mongoid::Paperclip
	has_mongoid_attached_file :image
	belongs_to :route
end
def image_url
Rails.logger.debug("treeeeeeeeee")
     image.url
   end

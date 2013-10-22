class Image
	include Mongoid::Document
	include Mongoid::Paperclip
	has_mongoid_attached_file :image
embedded_in :route
end
def image_url
Rails.logger.debug("treeeeeeeeee")
     image.url
end

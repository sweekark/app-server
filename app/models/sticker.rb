class Sticker
  include Mongoid::Document
  field :name, type: String
  field :display_name, type: String

  embeds_many :images, :cascade_callbacks => true
  attr_accessible :images
  accepts_nested_attributes_for :images, :allow_destroy => true

end
class Image
	include Mongoid::Document
	include Mongoid::Paperclip
	embedded_in :sticker
	has_mongoid_attached_file :image,
:path           => ':image/:id/:style.:extension',
    :storage        => :s3,
    :url            => ':s3_alias_url',
    :s3_host_alias  => 's3-ap-southeast-1.amazonaws.com/tromke',
    :s3_credentials => File.join(Rails.root, 'config', 's3.yml'),
    :styles => {
      :original => ['1920x1680>', :jpg],
      :small    => ['100x100#',   :jpg],
      :medium   => ['250x250',    :jpg],
      :large    => ['500x500>',   :jpg]
    },
    :convert_options => { :all => '-background white -flatten +matte' }
end


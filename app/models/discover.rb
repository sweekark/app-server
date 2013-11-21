class Discover
  include Mongoid::Document
  field :title, type: String
  field :content, type: String
belongs_to:route

  embeds_many :images, :cascade_callbacks => true
  attr_accessible :images
  accepts_nested_attributes_for :images, :allow_destroy => true

end
class Image
	include Mongoid::Document
	include Mongoid::Paperclip
	embedded_in :discover
	has_mongoid_attached_file :image,
:path           => ':image/:id/:style.:extension',
    :storage        => :s3,
    :url            => ':s3_alias_url',
    :s3_host_alias  => 'something.cloudfront.net',
    :s3_credentials => File.join(Rails.root, 'config', 's3.yml'),
    :styles => {
      :original => ['1920x1680>', :jpg],
      :small    => ['100x100#',   :jpg],
      :medium   => ['250x250',    :jpg],
      :large    => ['500x500>',   :jpg]
    },
    :convert_options => { :all => '-background white -flatten +matte' }
end


Mongo::Application.routes.draw do

match 'follows/:user_id' => 'follows#index', :defaults => {:format => 'json'}, :via => [:get]
resources :follows,
:defaults => { :format => 'json' }


resources :travel_times,
	  :defaults => { :format => 'json' }

resources :auths

resources :images

match 'routes' => 'routes#index', :defaults => {:format => 'json'}, :via => [:post]
match 'routes/:create' => 'routes#create', :defaults => {:format => 'json'}, :via => [:post]
resources :routes,
	  :defaults => { :format => 'json' }


resources :comments


resources :posts

resources :users,
:defaults => { :format => 'json' }


resources :projects


resources :articles

end

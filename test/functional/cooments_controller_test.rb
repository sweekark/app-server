require 'test_helper'

class CoomentsControllerTest < ActionController::TestCase
  setup do
    @cooment = cooments(:one)
  end

  test "should get index" do
    get :index
    assert_response :success
    assert_not_nil assigns(:cooments)
  end

  test "should get new" do
    get :new
    assert_response :success
  end

  test "should create cooment" do
    assert_difference('Cooment.count') do
      post :create, cooment: { conent: @cooment.conent }
    end

    assert_redirected_to cooment_path(assigns(:cooment))
  end

  test "should show cooment" do
    get :show, id: @cooment
    assert_response :success
  end

  test "should get edit" do
    get :edit, id: @cooment
    assert_response :success
  end

  test "should update cooment" do
    put :update, id: @cooment, cooment: { conent: @cooment.conent }
    assert_redirected_to cooment_path(assigns(:cooment))
  end

  test "should destroy cooment" do
    assert_difference('Cooment.count', -1) do
      delete :destroy, id: @cooment
    end

    assert_redirected_to cooments_path
  end
end

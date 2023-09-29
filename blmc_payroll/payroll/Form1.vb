Imports System.Drawing.Text
Imports System.IO
Imports MySql.Data.MySqlClient

Public Class Form1


    Implements DPFP.Capture.EventHandler
    Delegate Sub FunctionCall(ByVal param)
    Private Capturer As DPFP.Capture.Capture
    Dim count As Integer
    ' Public Event OnTemplate(ByVal template)
    Public Enroller As DPFP.Processing.Enrollment
    Private Template As DPFP.Template

    Private Sub OnTemplate(ByVal template)
        Invoke(New FunctionCall(AddressOf _OnTemplate), template)
    End Sub

    Private Sub _OnTemplate(ByVal template)
        Me.Template = template
        If Not template Is Nothing Then
            savetemplate()
            MsgBox("Enrollment Successful", MsgBoxStyle.Information, "BLMC")
            Me.Close()
        Else
            MessageBox.Show("The fingerprint template is not valid. Repeat fingerprint enrollment.", "Fingerprint Enrollment", MessageBoxButtons.OK, MessageBoxIcon.Exclamation)
        End If
    End Sub

    Protected Overridable Sub Init()
        Try

            Capturer = New DPFP.Capture.Capture()                   ' Create a capture operation.
            Enroller = New DPFP.Processing.Enrollment()
            UpdateStatus()
            If (Not Capturer Is Nothing) Then
                Capturer.EventHandler = Me                              ' Subscribe for capturing events.
            Else
                SetPrompt("Can't initiate capture operation!")
            End If

        Catch ex As DPFP.Error.SDKException
            ' MessageBox.Show("Can't initiate capture operation!", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error)
            MsgBox(ex.ToString, MsgBoxStyle.Exclamation, "XTech")
        End Try
    End Sub

    Protected Overridable Sub Processs(ByVal Sample As DPFP.Sample)
        DrawPicture(ConvertSampleToBitmap(Sample))
    End Sub

    Protected Function ConvertSampleToBitmap(ByVal Sample As DPFP.Sample) As Bitmap
        Dim convertor As New DPFP.Capture.SampleConversion()  ' Create a sample convertor.
        Dim bitmap As Bitmap = Nothing              ' TODO: the size doesn't matter
        convertor.ConvertToPicture(Sample, bitmap)

        Try
            If PictureBox1.Image Is Nothing Then
                Invoke(New FunctionCall(AddressOf _picturebox1draw), bitmap)
            ElseIf PictureBox2.Image Is Nothing Then
                Invoke(New FunctionCall(AddressOf _picturebox2draw), bitmap)
            ElseIf PictureBox3.Image Is Nothing Then
                Invoke(New FunctionCall(AddressOf _picturebox3draw), bitmap)
            ElseIf PictureBox4.Image Is Nothing Then
                Invoke(New FunctionCall(AddressOf _picturebox4draw), bitmap)
            Else

            End If
        Catch ex As Exception

        End Try

        ' TODO: return bitmap as a result
        Return bitmap
    End Function

    Protected Function ExtractFeatures(ByVal Sample As DPFP.Sample, ByVal Purpose As DPFP.Processing.DataPurpose) As DPFP.FeatureSet
        Dim extractor As New DPFP.Processing.FeatureExtraction()    ' Create a feature extractor
        Dim feedback As DPFP.Capture.CaptureFeedback = DPFP.Capture.CaptureFeedback.None
        Dim features As New DPFP.FeatureSet()
        extractor.CreateFeatureSet(Sample, Purpose, feedback, features) ' TODO: return features as a result?
        If (feedback = DPFP.Capture.CaptureFeedback.Good) Then
            Return features
        Else
            Return Nothing
        End If
    End Function

    Protected Sub StartCapture()
        If (Not Capturer Is Nothing) Then
            Try
                Capturer.StartCapture()
                SetPrompt("Using the fingerprint reader, scan your fingerprint.")
            Catch ex As DPFP.Error.SDKException
                'SetPrompt("Can't initiate capture!")
                MsgBox(ex.ToString, MsgBoxStyle.Exclamation, "XTech")
            End Try
        End If
    End Sub

    Protected Sub StopCapture()
        If (Not Capturer Is Nothing) Then
            Try
                Capturer.StopCapture()
            Catch ex As Exception
                SetPrompt("Can't terminate capture!")
            End Try
        End If
    End Sub

    Private Sub CaptureForm_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        Init()
        StartCapture()
    End Sub

    Private Sub CaptureForm_FormClosed(ByVal sender As System.Object, ByVal e As System.Windows.Forms.FormClosedEventArgs) Handles MyBase.FormClosed
        StopCapture()
        login.StartCapture()
    End Sub

    Sub OnComplete(ByVal Capture As Object, ByVal ReaderSerialNumber As String, ByVal Sample As DPFP.Sample) Implements DPFP.Capture.EventHandler.OnComplete
        If String.IsNullOrWhiteSpace(txtEmpNo.Text) Then
            MsgBox("No name has been entered for this capture")
        Else
            MakeReport("The fingerprint sample was captured.")
            SetPrompt("Scan the same fingerprint again.")
            Process(Sample)
        End If

    End Sub

    Sub OnFingerGone(ByVal Capture As Object, ByVal ReaderSerialNumber As String) Implements DPFP.Capture.EventHandler.OnFingerGone
        MakeReport("The finger was removed from the fingerprint reader.")
    End Sub

    Sub OnFingerTouch(ByVal Capture As Object, ByVal ReaderSerialNumber As String) Implements DPFP.Capture.EventHandler.OnFingerTouch
        MakeReport("The fingerprint reader was touched.")
    End Sub

    Sub OnReaderConnect(ByVal Capture As Object, ByVal ReaderSerialNumber As String) Implements DPFP.Capture.EventHandler.OnReaderConnect
        MakeReport("The fingerprint reader was connected.")
    End Sub

    Sub OnReaderDisconnect(ByVal Capture As Object, ByVal ReaderSerialNumber As String) Implements DPFP.Capture.EventHandler.OnReaderDisconnect
        MakeReport("The fingerprint reader was disconnected.")
    End Sub

    Sub OnSampleQuality(ByVal Capture As Object, ByVal ReaderSerialNumber As String, ByVal CaptureFeedback As DPFP.Capture.CaptureFeedback) Implements DPFP.Capture.EventHandler.OnSampleQuality
        If CaptureFeedback = DPFP.Capture.CaptureFeedback.Good Then
            MakeReport("The quality of the fingerprint sample is good.")
        Else
            MakeReport("The quality of the fingerprint sample is poor.")
        End If

    End Sub

    Protected Sub SetStatus(ByVal status)
        Invoke(New FunctionCall(AddressOf _SetStatus), status)
    End Sub

    Private Sub _SetStatus(ByVal status)
        StatusLine.Text = status
    End Sub

    Protected Sub SetPrompt(ByVal text)
        '  Invoke(New FunctionCall(AddressOf _SetPrompt), text)
    End Sub

    Private Sub _SetPrompt(ByVal text)
        Prompt.Text = text
    End Sub

    Protected Sub MakeReport(ByVal status)
        Try
            Invoke(New FunctionCall(AddressOf _MakeReport), status)
        Catch ex As Exception

        End Try

    End Sub

    Private Sub _MakeReport(ByVal status)
        StatusText.AppendText(status + Chr(13) + Chr(10))
    End Sub

    Protected Sub DrawPicture(ByVal bmp)

        Invoke(New FunctionCall(AddressOf _DrawPicture), bmp)

    End Sub

    Private Sub _DrawPicture(ByVal bmp)
        Picture.Image = New Bitmap(bmp, Picture.Size)
        ' My.Computer.Audio.Play(My.Resources.Single_wave, AudioPlayMode.Background)
    End Sub

    Sub _picturebox1draw(ByVal bmp)
        PictureBox1.Image = New Bitmap(bmp, 157, 168)
        ProgressBar1.Value = 25
    End Sub
    Sub _picturebox2draw(ByVal bmp)
        PictureBox2.Image = New Bitmap(bmp, 157, 168)
        ProgressBar1.Value = 50
    End Sub
    Sub _picturebox3draw(ByVal bmp)
        PictureBox3.Image = New Bitmap(bmp, 157, 168)
        ProgressBar1.Value = 75
    End Sub

    Sub _picturebox4draw(ByVal bmp)
        PictureBox4.Image = New Bitmap(bmp, 157, 168)
        ProgressBar1.Value = 100
    End Sub

    Sub pictureboxesclear()
        PictureBox1.Image = Nothing
        PictureBox2.Image = Nothing
        PictureBox3.Image = Nothing
        PictureBox4.Image = Nothing
    End Sub

    Private Sub Button1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button1.Click
        With OpenFileDialog1
            .Filter = "All Files|*.*|PNGs|*.png|GIFs|*.gif|JPEGs|*.jpg"
            .FilterIndex = 4
            If OpenFileDialog1.ShowDialog = DialogResult.OK Then
                PictureBox5.Image = Image.FromFile(OpenFileDialog1.FileName)
                PictureBox5.SizeMode = PictureBoxSizeMode.Zoom
                PictureBox5.BorderStyle = BorderStyle.FixedSingle
                ' Label1.Text = OpenFileDialog1.FileName
            End If
        End With
    End Sub

    Private Sub Button2_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button2.Click
        PictureBox5.Image = My.Resources.no_photo_available_icon
    End Sub


    Protected Sub Process(ByVal Sample As DPFP.Sample)

        Processs(Sample)



        ' Process the sample and create a feature set for the enrollment purpose.
        Dim features As DPFP.FeatureSet = ExtractFeatures(Sample, DPFP.Processing.DataPurpose.Enrollment)

        ' Check quality of the sample and add to enroller if it's good
        If (Not features Is Nothing) Then
            Try



                MakeReport("The fingerprint feature set was created.")
                Enroller.AddFeatures(features)        ' Add feature set to template.


            Finally
                UpdateStatus()

                ' Check if template has been created.
                Select Case Enroller.TemplateStatus
                    Case DPFP.Processing.Enrollment.Status.Ready    ' Report success and stop capturing


                        OnTemplate(Enroller.Template)
                        'SetPrompt("Click Close, and then click Fingerprint Verification.")
                        Template = Enroller.Template
                        StopCapture()
                    Case DPFP.Processing.Enrollment.Status.Failed   ' Report failure and restart capturing
                        Enroller.Clear()
                        StopCapture()
                        OnTemplate(Nothing)
                        StartCapture()

                End Select
            End Try
        End If


    End Sub

    Protected Sub UpdateStatus()
        ' Show number of fingerprint needed.
        SetStatus(String.Format("Fingerprint  needed: {0}", Enroller.FeaturesNeeded))
    End Sub




    Sub savetemplate()

        Dim isExists As Boolean

        If Not Directory.Exists(Application.StartupPath & "\Enrolled_Fingers") Then
            Directory.CreateDirectory(Application.StartupPath & "\Enrolled_Fingers")
        End If

        If Not Directory.Exists(Application.StartupPath & "\Enrolled_faces") Then
            Directory.CreateDirectory(Application.StartupPath & "\Enrolled_faces")
        End If


        isExists = checkFingerprint(txtEmpNo.Text, txtEmpNo.Text, txtFirstName.Text, txtLastName.Text)

        If My.Computer.FileSystem.FileExists(Application.StartupPath & "\Enrolled_Fingers\" & txtEmpNo.Text & ".fpt") Then
            If MessageBox.Show("User has already been enrolled", "", MessageBoxButtons.YesNo) = DialogResult.No Then
                Exit Sub
            Else



                Using fs As IO.FileStream = IO.File.Open(Application.StartupPath & "\Enrolled_Fingers\" & txtEmpNo.Text & ".fpt", IO.FileMode.Create, IO.FileAccess.Write)
                    Template.Serialize(fs)
                End Using
                PictureBox5.Image.Save(Application.StartupPath & "\Enrolled_faces\" & txtEmpNo.Text & ".jpg")


            End If


        Else

            Using fs As IO.FileStream = IO.File.Open(Application.StartupPath & "\Enrolled_Fingers\" & txtEmpNo.Text & ".fpt", IO.FileMode.Create, IO.FileAccess.Write)
                Template.Serialize(fs)
            End Using

            PictureBox5.Image.Save(Application.StartupPath & "\Enrolled_faces\" & txtEmpNo.Text & ".jpg")



        End If


    End Sub

    Private Sub GroupBox2_Enter(sender As Object, e As EventArgs) Handles GroupBox2.Enter

    End Sub

    Private Sub txtFirstName_KeyPress(sender As Object, e As KeyPressEventArgs) Handles txtFirstName.KeyPress
        If Asc(e.KeyChar) <> 8 Then
            If Asc(e.KeyChar) > 65 Or Asc(e.KeyChar) < 90 Or Asc(e.KeyChar) > 96 Or Asc(e.KeyChar) < 122 Then
                e.Handled = False
            End If
        End If
    End Sub

    Private Sub txtLastName_KeyPress(sender As Object, e As KeyPressEventArgs) Handles txtLastName.KeyPress
        If Asc(e.KeyChar) <> 8 Then
            If Asc(e.KeyChar) > 65 Or Asc(e.KeyChar) < 90 Or Asc(e.KeyChar) > 96 Or Asc(e.KeyChar) < 122 Then
                e.Handled = False
            End If
        End If
    End Sub
End Class
